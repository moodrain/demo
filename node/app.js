const Koa = require('koa')
const bodyParser = require('koa-bodyparser')
const controller = require('./config/controller')
const templating = require('./config/template')

const isProduction = process.env.NODE_ENV === 'production'

const app = new Koa()

app.use(async (ctx, next) => {
    let isStatic = ctx.request.url.indexOf('static') >= 0
    !isStatic && console.log(ctx.request.method + ' ' + ctx.request.url)
    let start = new Date().getTime(), 
        execTime
    await next()
    execTime = new Date().getTime() - start
    ctx.response.set('X-Response-Time', execTime + 'ms')
})
if (!isProduction) {
    let staticFiles = require('./config/static')
    app.use(staticFiles('/static/', __dirname + '/static'))
}
app.use(bodyParser())
app.use(templating(__dirname + '/src/views', {
    noCache: !isProduction,
    watch: !isProduction
}))
app.use(controller())
app.listen(8080)
console.log('app started at port 8080...')