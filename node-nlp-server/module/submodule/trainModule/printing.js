module.exports = function addPrinting(manager, products) {
    // manager.addNamedEntityText('product', product, ['en'], [product])
    manager.addDocument("en", "print all the available products", "command.print.available")

    // Example 1
manager.addDocument("en", "Can you print a list of all available products?", "command.print.available");

// Example 2
manager.addDocument("en", "I'd like to see a printout of all available products. Could you do that?", "command.print.available");

// Example 3
manager.addDocument("en", "Print me a comprehensive list of all available products.", "command.print.available");

// Example 4
manager.addDocument("en", "Print a list of all products that are currently available.", "command.print.available");

// Example 5
manager.addDocument("en", "I'm interested in a printed list of all available products. Can you arrange that?", "command.print.available");

// Example 6
manager.addDocument("en", "Print a list of all available products. That would be helpful.", "command.print.available");

// Example 7
manager.addDocument("en", "I need a printed list of all the products that are currently available. Can you do that for me?", "command.print.available");

// Example 8
manager.addDocument("en", "Could you print a list of all products currently available?", "command.print.available");

// Example 9
manager.addDocument("en", "Print a list of all available products in our inventory.", "command.print.available");

// Example 10
manager.addDocument("en", "Can you print a comprehensive list of available products?", "command.print.available");


    //if they select a products 
    products.forEach(product => {
        manager.addNamedEntityText('product', product, ['en'], [product])
        manager.addDocument("en", `Print all the available %product% that we have?`, "command.print.available.product", {product: product});

        // Example 1
manager.addDocument("en", `Could you print a list of all available %product% we currently have?`, "command.print.available.product", {product: product});

// Example 2
manager.addDocument("en", `Print me a list of all the %product% that are currently available.`, "command.print.available.product", {product: product});

// Example 3
manager.addDocument("en", `I'd like to see a printout of all available %product%. Can you do that?`, "command.print.available.product", {product: product});

// Example 4
manager.addDocument("en", `Can you print all the %product% that we currently have in stock?`, "command.print.available.product", {product: product});

// Example 5
manager.addDocument("en", `I'm interested in a list of available %product%. Can you print that for me?`, "command.print.available.product", {product: product});

// Example 6
manager.addDocument("en", `Print a list of all available %product%. That would be helpful.`, "command.print.available.product", {product: product});

// Example 7
manager.addDocument("en", `I need a printed list of all the %product% currently available.`, "command.print.available.product", {product: product});

// Example 8
manager.addDocument("en", `Could you print all the %product% that we currently have?`, "command.print.available.product", {product: product});

// Example 9
manager.addDocument("en", `Print a list of all available %product% in our inventory.`, "command.print.available.product", {product: product});

// Example 10
manager.addDocument("en", `Can you print a comprehensive list of available %product%?`, "command.print.available.product", {product: product});

    });
}