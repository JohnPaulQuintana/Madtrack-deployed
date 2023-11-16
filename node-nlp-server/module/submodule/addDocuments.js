const inventory = require('./trainModule/inventories')
const searched = require('./trainModule/searched')
const attendance = require('./trainModule/attendance')
const printing = require('./trainModule/printing')
const latest = require('./trainModule/latest')
const oldest = require('./trainModule/oldest')
const out = require('./trainModule/out')
const rejected = require('./trainModule/rejected')
const purchased = require('./trainModule/purchased')

const addDocuments = (manager, products) => {

    //inventories training set
    inventory(manager)
    //attendance
    attendance(manager)
    //printing
    printing(manager, products)
    //latest
    latest(manager)
    //oldest
    oldest(manager)
    //searched
    searched(manager, products)
    //out of stocks
    out(manager, products)
    //rejected
    rejected(manager, products)
    //purchased
    purchased(manager, products)
}
module.exports = {
    addDocuments,
};