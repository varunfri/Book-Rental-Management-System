// Load environment variables
// require('dotenv').config();

// Import required packages
const mysql = require('mysql');

// Database connection configuration
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laptop'
});

// Connect to the database
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to database: ' + err.stack);
        return;
    }
    console.log('Connected to database as ID ' + connection.threadId);
});

// Example query: Selecting data
connection.query('SELECT * FROM booking where email="varun@gmail.com"', (error, results, fields) => {
    if (error) {
        console.error('Error executing query: ' + error.stack);
        return;
    }
    console.log('Query results:', results[0]);
});

// Close the connection
connection.end((err) => {
    if (err) {
        console.error('Error closing connection: ' + err.stack);
        return;
    }
    console.log('Connection closed.');
});
