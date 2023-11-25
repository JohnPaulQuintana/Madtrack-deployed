module.exports = function rejectedProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'I want all the purchased products to be printed?', 'asking.products.purchased.all');

        // Example 1
manager.addDocument('en', 'Print all purchased products.', 'asking.products.purchased.all');

// Example 2
manager.addDocument('en', 'List all bought items, please.', 'asking.products.purchased.all');

// Example 3
manager.addDocument('en', 'I want a printout of all purchased products.', 'asking.products.purchased.all');

// Example 4
manager.addDocument('en', 'Print a list of bought products for me.', 'asking.products.purchased.all');

// Example 5
manager.addDocument('en', 'Can you show me all purchased items?', 'asking.products.purchased.all');

// Example 6
manager.addDocument('en', 'Print all products weve purchased.', 'asking.products.purchased.all');

// Example 7
manager.addDocument('en', 'Give me a list of purchased products, please.', 'asking.products.purchased.all');

// Example 8
manager.addDocument('en', 'Print all items we bought recently.', 'asking.products.purchased.all');

// Example 9
manager.addDocument('en', 'List all purchased products we have.', 'asking.products.purchased.all');

// Example 10
manager.addDocument('en', 'Can you print the purchased products list?', 'asking.products.purchased.all');

        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}