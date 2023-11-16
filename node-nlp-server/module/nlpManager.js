// import pkg from 'node-nlp';
const { NlpManager } = require("node-nlp");
const { addDocuments } = require("./submodule/addDocuments");
const { addPossibleAnswer } = require("./submodule/addAnswers");
const fs = require("fs");
const modelPath = "./model.nlp";

const trainAndProcessNLP = async (question, products) => {
    return new Promise(async (resolve, reject) => {
        try {
            const manager = new NlpManager(({ languages: ["en"] }));

            // Add documents and intents using the addDocuments function
            addDocuments(manager, products);

            // Add answers using the addAnswers function
            addPossibleAnswer(manager);
            
            // Check if the model file exists before trying to load it
            if (fs.existsSync(modelPath)) {
                // Load the pre-trained model
                await manager.load(modelPath);
            } else {
                console.log("its training");
                // Model file does not exist, so train and save the model

                // Train the model and save it
                await manager.train();
                await manager.save();
            }

            const response = await manager.process("en", question);
            
           // Use a ternary operator to get utteranceText or set it to undefined if no entities
            const utteranceText = response.entities && response.entities.length > 0
            ? response.entities[0].utteranceText
            : false;
            const { intent, score, answer } = response;
            resolve({ intent, score, answer, utteranceText });
        } catch (error) {
            console.log(error);
            reject(error);
        }
    });
};

module.exports = {
    trainAndProcessNLP,
};
// export default trainAndProcessNLP
