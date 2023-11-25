module.exports = function rejectedProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'Print all the rejected products that we have?', 'asking.products.rejected.all');

        // Example 1
manager.addDocument('en', 'Print all rejected products.', 'asking.products.rejected.all');

// Example 2
manager.addDocument('en', 'List all rejected items, please.', 'asking.products.rejected.all');

// Example 3
manager.addDocument('en', 'I want a printout of all rejected products.', 'asking.products.rejected.all');

// Example 4
manager.addDocument('en', 'Print a list of rejected products for me.', 'asking.products.rejected.all');

// Example 5
manager.addDocument('en', 'Can you show me all rejected items?', 'asking.products.rejected.all');

// Example 6
manager.addDocument('en', 'Print all products weve rejected.', 'asking.products.rejected.all');

// Example 7
manager.addDocument('en', 'Give me a list of rejected products, please.', 'asking.products.rejected.all');

// Example 8
manager.addDocument('en', 'Print all items we rejected recently.', 'asking.products.rejected.all');

// Example 9
manager.addDocument('en', 'List all rejected products we have.', 'asking.products.rejected.all');

// Example 10
manager.addDocument('en', 'Can you print the rejected products list?', 'asking.products.rejected.all');

        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}