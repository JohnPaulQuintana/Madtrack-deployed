const addPossibleAnswer = (manager) => {
    console.log('connected...')
    // Add answers for each intent
    manager.addAnswer("en","greetings.hello", "greetings");

    manager.addAnswer("en","asking.employee.many", {
        "model": "User",
        "table": "users",
        "query": "all",
        "exclude": "administrator",
    });
    manager.addAnswer("en","asking.employee.present.today", {
        "model": "Employee",
        "table": "employees",
        "query": "all",
        "include-employee": "employee_id",
    });
    //products
    manager.addAnswer("en","asking.products.all",{
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "all",
        "include-stock": "stocks",
    });
    //products latest
    manager.addAnswer("en","asking.products.latest", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "latest",
        "include-stock": "stocks",
    });
    //products latest
    manager.addAnswer("en","asking.products.oldest", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "oldest",
        "include-stock": "stocks",
    });
    //products searched
    manager.addAnswer("en","asking.products.search", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "search",
        "include-stock": "stocks",
    });

    manager.addAnswer("en","command.attendance", {
        "model": "Employee",
        "table": "employees",
        "query": "open",
        "include-attendance": "initializing Camera...",
    });

    //for all available stocks
    manager.addAnswer("en","command.print.available", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "print.all",
        "include-print": "stocks",
    });
    //for all available products only selected
    manager.addAnswer("en","command.print.available.product", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "print.only",
        "include-print": "stocks",
    });
    //for all out od stocks products
    manager.addAnswer("en","asking.products.out.all", {
        "model": "Inventory",
        "table": "inventories",
        "query": "all",
        "subquery": "print.outofstock.all",
        "include-print": "stocks",
    });
    //for all rejected stocks products
    manager.addAnswer("en","asking.products.rejected.all", {
        "model": "Rejected",
        "table": "rejecteds",
        "query": "all",
        "subquery": "print.rejected.all",
        "include-print": "stocks",
    });
    //for all purchased stocks products
    manager.addAnswer("en","asking.products.purchased.all", {
        "model": "Invoice",
        "table": "invoices",
        "query": "all",
        "subquery": "print.purchased.all",
        "include-print": "stocks",
    });
};

module.exports = {
    addPossibleAnswer,
};
