module.exports = function outProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'Which products are currently out of stock?', 'asking.products.out.all');
        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}