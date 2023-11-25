module.exports = function searchProducts(manager,products) {
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument("en", `How many %product% are in stock?`, "asking.products.search", {product: product});

        // Example 1
manager.addDocument("en", `How many %product% do we have in stock?`, "asking.products.search", {product: product});

// Example 2
manager.addDocument("en", `Can you tell me the quantity of %product% in stock?`, "asking.products.search", {product: product});

// Example 3
manager.addDocument("en", `What's the stock level for %product%?`, "asking.products.search", {product: product});

// Example 4
manager.addDocument("en", `How many %product% are currently in stock?`, "asking.products.search", {product: product});

// Example 5
manager.addDocument("en", `Tell me the stock quantity for %product%, please.`, "asking.products.search", {product: product});

// Example 6
manager.addDocument("en", `What's the current stock count for %product%?`, "asking.products.search", {product: product});

// Example 7
manager.addDocument("en", `Could you inform me about the stock quantity for %product%?`, "asking.products.search", {product: product});

// Example 8
manager.addDocument("en", `How many units of %product% do we have in stock?`, "asking.products.search", {product: product});

// Example 9
manager.addDocument("en", `I'd like to know the stock level for %product%. Can you help?`, "asking.products.search", {product: product});

// Example 10
manager.addDocument("en", `Can you provide information on the stock quantity for %product%?`, "asking.products.search", {product: product});

    });
}