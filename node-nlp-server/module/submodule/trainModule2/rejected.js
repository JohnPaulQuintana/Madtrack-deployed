module.exports = function rejectedProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'Print all the rejected products that we have?', 'asking.products.rejected.all');
        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}