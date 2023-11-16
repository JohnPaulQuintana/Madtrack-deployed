module.exports = function searchProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}