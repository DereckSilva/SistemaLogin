const express = require('express')
const app     = express()
const Redis   = require('ioredis')
const redis   = new Redis
const server  = require('http').createServer(app)

const socket = require('socket.io')(server, {
    cors: { origin: '*' }
})

socket.on('connection', (io) => {
    console.log('connected')
    console.log(io.id)
    redis.subscribe('laravel_database_testessssssss', () => {})

    redis.on('message', (channel, message) => {
        io.emit('client', JSON.parse(message))
    })

    io.on('disconect', (sock) => {
        console.log('disconected')
    })
})

server.listen(3000, () => {
    console.log('server rodando')
})