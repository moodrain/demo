const fs = require('fs')

function addMapping(router, mapping) {
    for (let url in mapping) {
        if (url.startsWith('GET ')) {
            let path = url.substring(4)
            router.get(path, mapping[url])
            console.log('url mapping registered: GET ' + path)
        } else if (url.startsWith('POST ')) {
            let path = url.substring(5)
            router.post(path, mapping[url])
            console.log('url mapping registered: POST ' + path)
        } else if (url.startsWith('PUT ')) {
            let path = url.substring(4)
            router.put(path, mapping[url])
            console.log('url mapping registered: PUT ' + path)
        } else if (url.startsWith('DELETE ')) {
            let path = url.substring(7)
            router.del(path, mapping[url])
            console.log('url mapping registered: DELETE ' + path)
        } else {
            console.log('url method unsupported: ' + url)
        }
    }
}

function addControllers(router, dir) {
    fs.readdirSync(dir).filter((f) => {
        return f.endsWith('.js')
    }).forEach((f) => {
        console.log('controller added: ' + f)
        let mapping = require(dir + '/' + f)
        addMapping(router, mapping)
    })
}

module.exports = (dir) => {
    let controllersDir = dir || (__dirname + '/../src/controllers'),
        router = require('koa-router')()
    addControllers(router, controllersDir)
    return router.routes()
}