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

1. Clone the repository:

    ```bash
    git clone git@github.com:LuisaeDev/twilio-voice-assistant.git
    ```

2. Navigate to the project directory:

    ```bash
    cd twilio-voice-assistant
    ```

3. Install Docker on your machine.

4. Run the following Docker command to install dependencies using Laravel Sail:

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

5. Update the Twilio credentials in the `.env` file:

    ```env
    TWILIO_SID=your_twilio_sid
    TWILIO_AUTH_TOKEN=your_twilio_auth_token
    TWILIO_PHONE_NUMBER=your_twilio_phone_number
    ```

6. Modify the seeder to define the demo agent and its phone number.

7. Run the migrations and seed the database:

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

Now, your Twilio Voice Assistant project is set up with the necessary dependencies and configurations. Make sure to customize the Twilio credentials and other settings based on your requirements.