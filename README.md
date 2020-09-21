
## Online demo

[https://twilio-demo.nimbo.pro/](https://twilio-demo.nimbo.pro/)

***
### Sign In
All the fields are mandatory, but they can be false, except the telephone number since this number will be considered as the administrator telephone number.

### Log In
For the demo a functionality to recover passwords was not developed, so in case of forgetting it, it will be necessary to create a new account, (all accounts will be automatically deleted at midnight).

### Provider phones
All vendor phones were hard coded to a demo twilio phone, so if you need to change it for a real one, you can changeit with a single click over the number, end then "intro key" to save the changes.

### Twilio config
To configure Twilio, it is necessary to click on the dropdown with the user's email. A modal will appear with the twilio fields.
(The information will be stored in data class so it is highly recommended to destroy the configuration when you finish using the demo)

### Call status tracking
It is possible to track the status of the call from the chrome console.

### Known issues
Twilio's platform does not detect when the first number rejects the call and continues the connection process, and the provider would receive an empty call, which could be annoying.
