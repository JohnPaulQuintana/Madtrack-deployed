module.exports = function rejectedProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'I want all the purchased products to be printed?', 'asking.products.purchased.all');
        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}