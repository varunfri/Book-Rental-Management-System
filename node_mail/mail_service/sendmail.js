const nodemailer = require("nodemailer");
require('dotenv').config();

const transporter = nodemailer.createTransport({
  host: "smtp.gmail.com",
  port: 587,
  secure: false, // Use `true` for port 465, `false` for all other ports
  auth: {
    user: process.env.USER,
    pass: process.env.PASS,
  },
});

const mailOptions ={
    from:{
        name: "Varun K V", address: process.env.USER,
    },
    to: "vv137941@gmail.com",
    subject: "COnfirm Message",
    text:"Hello World",
    html: "<b>Hello </b>"
}

// sending mail 
const sendMail = async(transporter, mailOptions) =>{
    try{
        await transporter.sendMail(mailOptions);
        console.log("Emial Sent");
   
    } catch(error){
        console.error(error);
    }
}

sendMail(transporter, mailOptions);