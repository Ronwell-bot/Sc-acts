const express = require('express');
const bodyParser = require('body-parser');
const multer = require('multer');
const mysql = require('mysql');
const bcrypt = require('bcrypt');
const path = require('path');

const app = express();
const upload = multer({ dest: 'uploads/' });

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'travel_bliss'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connected to database');
});

app.post('/api/register', upload.single('profile_picture'), async (req, res) => {
    const { name, email, sex, age, username, password } = req.body;
    const profilePicture = req.file ? req.file.filename : null;

    const passwordHash = await bcrypt.hash(password, 10);

    const query = 'INSERT INTO Users (Username, PasswordHash, Email, Sex, Age, ProfilePicture) VALUES (?, ?, ?, ?, ?, ?)';
    db.query(query, [username, passwordHash, email, sex, age, profilePicture], (err, result) => {
        if (err) {
            console.error(err);
            return res.status(500).send('Server error');
        }
        res.status(200).send('User registered successfully');
    });
});

app.use('/uploads', express.static(path.join(__dirname, 'uploads')));

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
