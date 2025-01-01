const fs = require('fs');
const PDFDocument = require('pdfkit');
const mysql = require('mysql');
const nodemailer = require("nodemailer");
require('dotenv').config();


// Database connection configuration
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'laptop'
});

// Connect to database
connection.connect();

// Function to fetch data and generate PDF
function generatePDFFromDatabase(book_id, pdfFilePath) {
    const doc = new PDFDocument();
    doc.pipe(fs.createWriteStream(pdfFilePath));

    // Query database for booking details
    connection.query('SELECT * FROM booking WHERE book_id = 77', [book_id], (error, results, fields) => {
        if (error) {
            console.error(error);
            return;
        }

        if (results.length > 0) {
            const booking = results[0];

            // Customize PDF content with fetched data
            doc.font('Helvetica-Bold').fontSize(25).text('Receipt', { align: 'center' });
            doc.moveDown();
            doc.font('Helvetica').fontSize(12).text(`Booking ID: ${booking.book_id}`);
            doc.font('Helvetica').fontSize(12).text(`Customer Name: ${booking.email}`);
            doc.font('Helvetica').fontSize(12).text(`Laptop Model: ${booking.return_date}`);
            doc.font('Helvetica').fontSize(12).text(`Price: ${booking.price}`);
             doc.font('Helvetica').fontSize(12).text(`Price: ${booking.book_status}`);
            // Add more fields as necessary

            doc.end();
            console.log()
            // Send email with generated PDF   
            sendEmailWithAttachment(booking.email, pdfFilePath);
        } else {
            console.log(`Booking with ID ${booking.book_id} not found.`);
        }
    });
}

//recipent Email 
 
// Function to send email with attachment (nodemailer)
async function sendEmailWithAttachment(email, pdfFilePath) {
    // Create a SMTP transporter
    const transporter = nodemailer.createTransport({
        host: "smtp.gmail.com",
        port: 587,
        secure: false, // Use `true` for port 465, `false` for all other ports
        auth: {
          user: process.env.USER,
          pass: process.env.PASS,
        },
      });
      let htmlEmail= `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laptop Rental Information</title>
    <style>
        /* Reset styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        
        p {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            font-size: 14px;
            color: #666;
            text-align: center;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo img {
            max-width: 500px;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://i.ibb.co/xhyJVPR/logo-1.png" alt="Company Logo">
        </div>
        
        <h1>Laptop Rental Information</h1>
        <p>Hello [User's Name],</p>
        
        <p>Thank you for choosing our laptop rental service. Here are the details of your rental:</p>
        
        <ul>
            <li><strong>Laptop Model:</strong> [Laptop Model Name]</li>
            <li><strong>Rental Start Date:</strong> [Start Date]</li>
            <li><strong>Rental Duration:</strong> [Number of Days]</li>
            <li><strong>Total Rental Cost:</strong> [Total Cost]</li>
        </ul>
        
        <p>Please ensure that you review the terms and conditions of the rental agreement. If you have any questions or need further assistance, feel free to contact us at [Your Contact Information].</p>
        
        <p>Thank you again for choosing our services.</p>
        
        <div class="footer">
            <p>Best regards,<br>Your Rental Service Team<br><span class="highlight">RentNRun</span></p>
        </div>
    </div>
</body>
</html>
`;

    // Message object
    let message = {
        from: {
            name: "RentNRun",
            address: process.env.USER
        }, // Sender address
        to: ' vv137941@gmail.com', // List of recipients
        subject: 'Your Laptop Rental Receipt', // Subject line
        html: htmlEmail, // Plain text body
        attachments: [
            {
                filename: 'receipt.pdf', // Name of the attachment
                path: pdfFilePath // Path to the PDF file
            }
        ]
    };

    // Send email
    // let info = await transporter.sendMail(message);
    // console.log('Email sent: %s', info.messageId);

    // sending mail 
const sendMail = async(transporter, message) =>{
    try{
        await transporter.sendMail(message);
        console.log("Emial Sent");
    } catch(error){
        console.error(error);
    }
}

sendMail(transporter, message);
}

// Example usage: Assuming you have a booking ID and PDF file path
const bookingId = 77; // Replace with actual booking ID
const pdfFilePath = 'receipt.pdf'; // Replace with desired PDF file path
generatePDFFromDatabase(bookingId, pdfFilePath);

// Close database connection when done
connection.end();
