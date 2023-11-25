module.exports = function addPrinting(manager, products) {
    // manager.addNamedEntityText('product', product, ['en'], [product])
    manager.addDocument("en", "print all the available products", "command.print.available")

    //if they select a products 
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument("en", `Print all the available %product% that we have?`, "command.print.available.product", {product: product});
    });
}