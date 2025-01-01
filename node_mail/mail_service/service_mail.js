// const nodemailer = require('nodemailer');
// require('dotenv').config();
const mysql = require('mysql');

// Database Connection 
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laptop'
});

// Connect to database 
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err.stack);
        return;
    }
    console.log('Connected to the database');
});

// Function to push data to database
function db_push(name, email, category, req_type, message) {
    const query = `INSERT INTO service (name, email, category, req_type, message) VALUES (?, ?, ?, ?, ?)`;
    const values = [name, email, category, req_type, message];

    connection.query(query, values, (err, results) => {
        if (err) {
            console.error('Error inserting data into database:', err.stack);
            return;
        }
        console.log('Data inserted successfully:', results.insertId);
    });
}

 