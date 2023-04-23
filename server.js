const express = require('express')
const app     = express()
const Redis   = require('ioredis')
const sub   = new Redis
const pub   = new Redis
const server  = require('http').createServer(app)

const MAX_USERS_PER_ROOM = 2;

const io = require('socket.io')(server, {
    cors: { origin: '*' }
})

// emit => emitir um evento
// on => escutar um evento

// io => está relacionado com todos os usuários em uma determinada conexão
// socket => está relacionado com um único usuário dentro de uma conexão

//setando o máximo de ouvintes por 
io.setMaxListeners(2)

// middleware para o meu canal
io.of('/teste').use((socket, next) => {
    if (socket.server.eio._eventsCount > 2) {
        socket.server.eio._eventsCount--
        //podemos emitir um alert sobre a sala estar cheia
    } else {
        console.log(socket.server.eio._eventsCount++)
        next()
    }
})

// criar estrutura de lista de espera dentro de um chat (como se fosse uma parte do suporte em tempo real)
    // -> estrutura de chat para vendedor e comprador

// criar estrutura para comentários dentro de um determinado post
    // -> estrutura de comentários em post dos vendedores

// canal dedicado para um chat socket específico
io.of('/teste').on('connection', (socket) => {
    console.log('cliente conectado ' + socket.id)

    // dessa forma aqui manda apenas para dois canais, quem envia a mensagem não recebe nada
    sub.subscribe('laravel_database_testessssssss', () => {
    })

    sub.on('message', (channel, message) => {
        socket.emit('client', JSON.parse(message))
    })

    socket.on('disconnect', (socket) => {
        console.log('cliente desconectado ' + socket.id)
    })
    
})

server.listen(3000, () => {
    console.log('server rodando')
})
