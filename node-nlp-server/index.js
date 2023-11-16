const express = require('express');
const nlp = require('./module/nlpManager');
const cors = require('cors'); // Import the cors package

const app = express();
app.use(cors()); // Use cors middleware to enable CORS
app.use(express.json());

app.post('/nlp', async (req, res) => {
    try {
         // Perform NLP operations here
         // call the processNLPQuestion
         console.log(req.body)
        const nlpResponse = await nlp.trainAndProcessNLP(req.body.text, req.body.products)
        console.log(nlpResponse)
        // Return the NLP result to the client
        res.json(nlpResponse)

      } catch (error) {
        console.error(error);
        // Handle errors and send an error response
        res.status(500).json({ error: 'An error occurred' });
      }  
    })

// Retrieve the Laravel port from the environment variable
const laravelPort = process.env.LARAVEL_PORT || 8000;
app.listen(laravelPort, () => {
  console.log(`Node.js server is running on port ${laravelPort}`);
});
