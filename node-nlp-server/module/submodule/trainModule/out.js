module.exports = function outProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument('en', 'Which products are currently out of stock?', 'asking.products.out.all');

        // Example 1
manager.addDocument('en', 'Can you tell me which products are currently out of stock?', 'asking.products.out.all');

// Example 2
manager.addDocument('en', 'Im curious, which items are out of stock right now?', 'asking.products.out.all');

// Example 3
manager.addDocument('en', 'Could you let me know which products are currently unavailable?', 'asking.products.out.all');

// Example 4
manager.addDocument('en', 'What items are out of stock at the moment?', 'asking.products.out.all');

// Example 5
manager.addDocument('en', 'Any idea which products are not in stock currently?', 'asking.products.out.all');

// Example 6
manager.addDocument('en', 'I need to know which items are out of stock. Can you help?', 'asking.products.out.all');

// Example 7
manager.addDocument('en', 'Wondering which products are currently out of stock. Any info?', 'asking.products.out.all');

// Example 8
manager.addDocument('en', 'Do you have information on which products are currently out of stock?', 'asking.products.out.all');

// Example 9
manager.addDocument('en', 'Which items are out of stock right now? Im curious.', 'asking.products.out.all');

// Example 10
manager.addDocument('en', 'Any chance you can inform me about the products that are out of stock?', 'asking.products.out.all');

        // manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});
    });
}