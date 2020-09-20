const { post } = require('request-promise');

post({
  uri: 'https://api.zenvia.com/v1/channels/whatsapp/messages',
  headers: {
    'X-API-TOKEN': 'YOUR_API_TOKEN'
  },
  body: {
    from: 'sender-identifier',
    to: 'recipient-identifier',
    contents: [{
      type: 'text',
      text: 'Some text message'
    }]
  },
  json: true
})
.then((response) => {
  console.log('Response:', response);
})
.catch((error) => {
  console.log('Error:', error);
});
