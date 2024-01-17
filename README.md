# Twilio Voice Assistant

## Application Description (English)

The Twilio Voice Assistant is a REST API equipped with a Twilio webhook to handle calls from Twilio's Voice IP service.
Here are key elements of the application:

- The application features a service layer located in the `./App/Services/` directory.
- All services registered in this layer have their respective interfaces (Contracts) for dependency injection, along with their Facade class.
- There is a dedicated service layer to handle calls from the Twilio webhook.
- There is a separate service layer to define and send responses in TwiML format.
- All response messages have been defined in the language package located at `lang/en/voice_assistant.php`.
- A middleware has been added to validate that calls (requests) originate from Twilio.

## Installation

1. **Create a Twilio Account:**

   - Go to [Twilio](https://www.twilio.com/) and sign up for a new account.
   - Follow the on-screen instructions to verify your account.

2. **Clone the repository:**

    ```bash
    git clone git@github.com:LuisaeDev/twilio-voice-assistant.git
    ```

3. **Navigate to the project directory:**

    ```bash
    cd twilio-voice-assistant
    ```

4. **Install Docker on your machine.**

5. **Run the following Docker command to install dependencies using Laravel Sail:**

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

6. **Update the Twilio credentials in the `.env` file:**

    ```env
    TWILIO_SID=your_twilio_sid
    TWILIO_AUTH_TOKEN=your_twilio_auth_token
    TWILIO_PHONE_NUMBER=your_twilio_phone_number
    ```

7. **Modify the seeder to define the demo agent and its phone number.**

8. **Run the migrations and seed the database:**

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

9. **Install and run ngrok in your environment.** This step is crucial for exposing your local server to the internet, allowing Twilio to send webhooks to your development environment. Visit [ngrok](https://ngrok.com/) for installation instructions.

10. **Configure Twilio Voice IP Service:**

    - Log in to your Twilio account.
    - Navigate to the [Twilio Console](https://www.twilio.com/console).
    - Create a new Voice project and set up a TwiML Bin or Function to handle incoming calls.
    - Use the ngrok URL as the webhook for incoming calls in your TwiML configuration.

Now, your Twilio Voice Assistant project is set up, and Twilio is configured to forward incoming calls to your local environment through ngrok. Make sure to customize the Twilio credentials and other settings based on your requirements.
