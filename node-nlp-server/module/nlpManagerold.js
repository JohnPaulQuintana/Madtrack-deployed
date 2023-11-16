// import pkg from 'node-nlp';
const { NlpManager } = require('node-nlp');
const fs = require('fs');
const path = require('path');
const modelPath = path.join(__dirname, 'model.nlp');

// const trainAndProcessNLP = async (question) => {
//   return new Promise(async (resolve, reject) => {
//     try {
//       const manager = new NlpManager({ languages: ["en"] });
//       // Adds the utterances and intents for the NLP
//       manager.addDocument("en", "hello", "greetings.hello");
//       manager.addDocument("en", "hi", "greetings.hello");
//       manager.addDocument("en", "howdy", "greetings.hello");

//       // question for employee
//       // manager.addDocument("en", "how many employee do we have", "asking.employee.many");
//       manager.addDocument("en", "give me the list of present today", "asking.employee.present.today")

//       // question for products
//       manager.addDocument("en", "How many products are in stock?", "asking.products.all");
//       manager.addDocument("en", "What's the product count?", "asking.products.all");
//       manager.addDocument("en", "Total products available?", "asking.products.all");
//       manager.addDocument("en", "Number of items in stock?", "asking.products.all");
//       manager.addDocument("en", "What's the current stock level?", "asking.products.all");
//       manager.addDocument("en", "Total product count?", "asking.products.all");
//       manager.addDocument("en", "How many product types do we have?", "asking.products.all");
//       manager.addDocument("en", "Product inventory count?", "asking.products.all");
//       manager.addDocument("en", "Number of different products?", "asking.products.all");
      
     
//       // open the attendance page
//       manager.addDocument("en", "activate the attendance system", "command.attendance");

//       // printing
//       manager.addDocument("en", "print all the available products", "command.print.available")
     
//       // thanks
//       manager.addDocument("en", "thank you","thanks")

//       // Train also the NLG
//       manager.addAnswer(
//         "en",
//         "greetings.hello",
//         "greetings"
//       );
//       manager.addAnswer(
//         "en",
//         "greetings.hello",
//         "greetings"
//       );
//       manager.addAnswer(
//         "en",
//         "greetings.asking",
//         "greetings"
//       );

//       // employee
//       manager.addAnswer(
//         "en",
//         "asking.employee.many",
//         {
//           'model':'User',
//           'table':'users',
//           'query':'all',
//           'exclude':'administrator',
        
//         }
//       );

//       // employee presents
//       manager.addAnswer(
//         "en",
//         "asking.employee.present.today",
//         {
//           'model':'Employee',
//           'table':'employees',
//           'query':'all',
//           'include-employee':'employee_id',
        
//         }
//       );

//       // products all
//       manager.addAnswer(
//         "en",
//         "asking.products.all",
//         {
//           'model':'Inventory',
//           'table':'inventories',
//           'query':'all',
//           'include-stock':'stocks',
        
//         }
//       );

//       // attendance activate
//       manager.addAnswer(
//         "en",
//         "command.attendance",
//         {
//           'model':'Employee',
//           'table':'employees',
//           'query':'open',
//           'include-attendance':'initializing Camera...',
        
//         }
//       );

//       // print available products
//       manager.addAnswer("en","command.print.available",
//         {
//           'model':'Inventory',
//           'table':'inventories',
//           'query':'all',
//           'include-print':'stocks',
//         }
//       )

//       // thanks
//       manager.addAnswer(
//         "en",
//         "thanks",
//         "your welcome!"
//       );
//       manager.addAnswer(
//         "en",
//         "thanks",
//         "Im happy to serve you!"
//       );
//       manager.addAnswer(
//         "en",
//         "thanks",
//         "have a good day!"
//       );
//       // Check if a trained model exists
//       const modelPath = "./model.nlp";
//       const exists = fs.existsSync(modelPath);

//       if (exists) {
//         // Load the existing model
//         await manager.load(modelPath);
//       } else {
//         // Train the model and save it
//         await manager.train();
//         await manager.save(modelPath);
//       }

//       const response = await manager.process("en", question);
//       const { intent, score, answer } = response;
//       resolve({intent, score, answer});
//     } catch (error) {
//       console.log(error)
//       reject(error);
//     }
//   });
// };

// module.exports = {
//   trainAndProcessNLP,
// };
// export default trainAndProcessNLP




const trainAndProcessNLP = async (question) => {
  try {
    const manager = new NlpManager({ languages: ["en"] });

    // Define training data
    const trainingData = [
      { input: "hello", output: "greetings.hello" },
      { input: "hi", output: "greetings.hello" },
      { input: "howdy", output: "greetings.hello" },
      // question for employee
      { input: "give me the list of present today", output: "asking.employee.present.today"},
      //products
      { input: "How many products are in stock?", output: "asking.products.all"},
      { input: "Number of items in stock?", output: "asking.products.all"},
      { input: "What's the current stock level?", output: "asking.products.all"},
      { input: "Total product count?", output: "asking.products.all"},
      { input: "How many product types do we have?", output: "asking.products.all"},
      { input: "Product inventory count?", output: "asking.products.all"},
      { input: "Number of different products?", output: "asking.products.all"},
      // open the attendance page
      { input: "activate the attendance system", output: "command.attendance"},
      // printing
      { input: "print all the available products", output: "command.print.available"},
      // Add more training data here...
    ];

    // Load training data
    trainingData.forEach((data) => {
      manager.addDocument("en", data.input, data.output);
    });

    // Define answers
    const answers = {
      "greetings.hello": "greetings",
      "asking.employee.many": {
        model: 'User',
        table: 'users',
        query: 'all',
        exclude: 'administrator',
      },
      "asking.employee.present.today": {
        model: 'Employee',
        table: 'employees',
        query: 'all',
        'include-employee': 'employee_id',
      },
      "asking.products.all": {
        model: 'Inventory',
        table: 'inventories',
        query: 'all',
        'include-stock': 'stocks',
      },
      "command.attendance": {
        model: 'Employee',
        table: 'employees',
        query: 'open',
        'include-attendance': 'initializing Camera...',
      },
      "command.print.available": {
        model: 'Inventory',
        table: 'inventories',
        query: 'all',
        'include-print': 'stocks',
      },
      "thanks": ["your welcome!", "Im happy to serve you!", "have a good day!"],
    };

    // Load answers
    Object.keys(answers).forEach((intent) => {
      manager.addAnswer("en", intent, answers[intent]);
    });

    // Check if a trained model exists
    const exists = fs.existsSync(modelPath);

    if (exists) {
      // Load the existing model
      await manager.load(modelPath);
    } else {
      // Train the model and save it
      await manager.train();
      await manager.save(modelPath);
    }

    // Process the question
    const response = await manager.process("en", question);
    const { intent, score, answer } = response;
    console.log(response)
    return { intent, score, answer };
  } catch (error) {
    console.error(error);
    throw error;
  }
};

module.exports = {
  trainAndProcessNLP,
};