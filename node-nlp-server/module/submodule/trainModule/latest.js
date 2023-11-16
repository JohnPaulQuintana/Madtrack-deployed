module.exports = function addLatest(manager){
    // latest products
    manager.addDocument("en", "What are the newest arrivals in our product inventory?", "asking.products.latest");
    manager.addDocument("en", "Which products have been added most recently?", "asking.products.latest");
    manager.addDocument("en", "Can you provide a list of the latest products?", "asking.products.latest");
    // manager.addDocument("en", "What is the release date of our newest products?", "asking.products.latest");
    manager.addDocument("en", "Which items are considered the latest additions to our stock?", "asking.products.latest");
    manager.addDocument("en", "What's the most recently added product?", "asking.products.latest");
    manager.addDocument("en", "Can you show me the products added this month?", "asking.products.latest");
    manager.addDocument("en", "Which products were added in the last week?", "asking.products.latest");
    manager.addDocument("en", "What is the latest product in our catalog?", "asking.products.latest");
    manager.addDocument("en", "Which items have been recently restocked?", "asking.products.latest");
}