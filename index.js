const http = require('http');
const path = require('path');
const fs = require('fs');
const regUsers = require('./Models/Login');


const server = http.createServer((req, res) => {
    if (req.url === '/') {
        fs.readFile(path.join(__dirname, 'public', 'index.html'), (err, data) => {
            if (err) throw err;
            res.writeHead(200, { 'Content-type': 'text/html' })
            res.end(data);
        });

    }

    if (req.url === '/login') {
        fs.readFile(path.join(__dirname, 'public', 'login.html'), (err, data) => {
            if (err) throw err;
            res.writeHead(200, { 'Content-type': 'text/html' })
            res.end(data);
        });

    }

    if (req.url == '/login' && req.method == 'POST') {
        whole = [];
        req.on('data', (chunk) => {
            whole.push(chunk.toString().replace(/=/g, ',').split("&"));
        })
        console.log(whole);
        req.on('end', () => {
            let username = whole[0][0].split(',')[1];
            let password = whole[0][1].split(',')[1];

            let user = regUsers.find(user => user.username == username && user.password == password);
            if (!user) {
                res.writeHead(400, { 'Content-type': 'application/json' });
                res.end(JSON.stringify({ err: 'Incorrect Credentials' }));
                return
            }

            fs.readFile(path.join(__dirname, 'public', 'user.html'), (err, data) => {
                if (err) throw err;
                res.writeHead(200, { 'Content-type': 'text/html' })
                res.end(data);
            });
        })
    }
    // if (req.url === '/login') {
    //     let body = [];
    //     req.on('data', (chunk) => {
    //         body.push(chunk);
    //     }).on('end', () => {
    //         body = Buffer.concat(body).toString();
    //         // at this point, `body` has the entire request body stored in it as a string
    //     });
    //     console.log(body);
    //     fs.readFile(path.join(__dirname, 'public', 'login.html'), (err, data) => {
    //         if (err) throw err;
    //         res.writeHead(200, { 'Content-type': 'text/html' })
    //         res.end(data);
    //     });
    // }
});

const PORT = process.env.PORT || 5000;

server.listen(PORT, () => console.log(`Server running on port ${PORT}`));