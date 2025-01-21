import hashlib
import os
import time
from flask import Flask, render_template, request, redirect, url_for, session, flash
import sqlite3
from werkzeug.security import generate_password_hash, check_password_hash
import sendgrid
from sendgrid.helpers.mail import Mail, Email, To, Content

app = Flask(__name__)
app.secret_key = '7e739683bca81a665f5e0f4aa4f733bdc8040ef492f7722a2dd7013ac8f82af5'  # Use a strong secret key for session management


# Function to connect to the database
def get_db_connection():
    conn = sqlite3.connect('users.db')
    conn.row_factory = sqlite3.Row
    return conn

# Route to the login and registration page
@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']

        # Handling login
        if 'login' in request.form:
            conn = get_db_connection()
            user = conn.execute('SELECT * FROM users WHERE email = ?', (email,)).fetchone()
            conn.close()

            if user and check_password_hash(user['password'], password):  # Check if password matches
                session['user_id'] = user['id']
                session['username'] = user['name']
                return redirect(url_for('aulas.html'))  # Redirect to aulas.html after login

        # Handling registration
        if 'register' in request.form:
            name = request.form['name']
            hashed_password = generate_password_hash(password)  # Encrypt the password
            conn = get_db_connection()
            conn.execute('INSERT INTO users (name, email, password) VALUES (?, ?, ?)', (name, email, hashed_password))
            conn.commit()
            conn.close()
            flash('Registration successful! Please log in.')  # Flash message after successful registration
            return redirect(url_for('index'))  # Redirect back to index after registration

    return render_template('index.html')  # Render the index.html


# Route for the aulas page (protected route)
@app.route('/aulas')
def aulas():
    if 'user_id' not in session:
        return redirect(url_for('index'))  # If not logged in, redirect to login

    username = session['username']
    return render_template('aulas.html', username=username)

# Route for logout
@app.route('/logout')
def logout():
    session.clear()  # Clears the session
    return redirect(url_for('index'))  # Redirect to the login page

# Route for password recovery
@app.route('/forgot-password', methods=['GET', 'POST'])
def forgot_password():
    if request.method == 'POST':
        email = request.form['email']
        
        # Verifying if the email is in the database
        conn = get_db_connection()
        user = conn.execute('SELECT * FROM users WHERE email = ?', (email,)).fetchone()
        conn.close()

        if user:
            # Generate a password reset token
            token = generate_reset_token(user['id'])

            # Store the token and expiration date in the database
            conn = get_db_connection()
            conn.execute('UPDATE users SET reset_token = ?, reset_token_expiry = ? WHERE email = ?', 
                         (token, int(time.time()) + 3600, email))  # Token expires in 1 hour
            conn.commit()
            conn.close()

            # Send the recovery email with the token link
            send_recovery_email(email, token)
            
            return redirect(url_for('success'))
        else:
            return render_template('email_not_found.html')

    return render_template('forgot_password.html')  # Page for the password recovery form

# Function to generate a password reset token
def generate_reset_token(user_id):
    token = hashlib.sha256(f'{user_id}{time.time()}{os.urandom(24)}'.encode()).hexdigest()
    return token

# Function to send recovery email using SendGrid
def send_recovery_email(email, token):
    from_email = Email("kiocodecplusplus@gmail.com")  # Replace with your own email
    to_email = To(email)  # Recipient's email
    subject = "Password Recovery"
    recovery_link = f'http://localhost:5000/reset-password/{token}'  # Local test link

    content = Content("text/plain", f'Click the link below to reset your password: {recovery_link}')

    mail = Mail(from_email, to_email, subject, content)

    try:
        sg = sendgrid.SendGridAPIClient(api_key='your-sendgrid-api-key')  # Replace with your SendGrid API key
        response = sg.send(mail)
        print(f"Email sent with status: {response.status_code}")
    except Exception as e:
        print(f"Error sending email: {e}")
        return redirect(url_for('email_error'))

# Route for email error page
@app.route('/email-error')
def email_error():
    return render_template('email_error.html')

# Route for resetting the password
@app.route('/reset-password/<token>', methods=['GET', 'POST'])
def reset_password(token):
    conn = get_db_connection()
    user = conn.execute('SELECT * FROM users WHERE reset_token = ?', (token,)).fetchone()
    conn.close()

    if user:
        if user['reset_token_expiry'] > int(time.time()):  # Check if token is expired
            if request.method == 'POST':
                new_password = request.form['password']
                hashed_password = generate_password_hash(new_password)

                # Update the password in the database and clear the token
                conn = get_db_connection()
                conn.execute('UPDATE users SET password = ?, reset_token = ?, reset_token_expiry = ? WHERE id = ?',
                             (hashed_password, None, None, user['id']))
                conn.commit()
                conn.close()

                return redirect(url_for('index'))  # Redirect to login page after password reset

            return render_template('reset_password.html', token=token)
        else:
            return 'Token expired or invalid.'

    return 'Invalid token.'

# Route for success page (after successful password recovery)
@app.route('/success')
def success():
    return render_template('success.html')

# Function to create the database and users table if they don't exist
def create_db():
    conn = sqlite3.connect('users.db')
    c = conn.cursor()
    c.execute('''CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL UNIQUE,
                    password TEXT NOT NULL,
                    reset_token TEXT,
                    reset_token_expiry INTEGER)''')
    conn.commit()
    conn.close()

# Run the database creation function
create_db()

# Start the app
if __name__ == '__main__':
    app.run(debug=True)
