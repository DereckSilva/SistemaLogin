const express = require('express')
const app     = express()
const Redis   = require('ioredis')
const redis   = new Redis
const server  = require('http').createServer(app)

const io = require('socket.io')(server, {
    cors: { origin: '*' }
})

// emit => emitir um evento
// on => escutar um evento

// io => está relacionado com todos os usuários em uma determinada conexão
// socket => está relacionado com um único usuário dentro de uma conexão

io.on('connection', (socket) => {
    console.log('connected')

    redis.subscribe('laravel_database_testessssssss', () => {})

    redis.on('message', (channel, message) => {
        socket.emit('client', JSON.parse(message))
    })

    socket.on('disconect', (socket) => {
        console.log('disconected')
    })
})

server.listen(3000, () => {
    console.log('server rodando')
})
