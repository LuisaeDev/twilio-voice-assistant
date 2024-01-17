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

1. **Install ngrok in your environment.** This step is crucial for exposing your local server to the internet, allowing Twilio to send webhooks to your development environment. Visit [ngrok](https://ngrok.com/) for installation instructions.

2. **Run ngrok in your terminal**
    ```bash
    ngrok http 80
    ```

3. **Create a Twilio Account:**

   - Go to [Twilio](https://www.twilio.com/) and sign up for a new account.
   - Follow the on-screen instructions to verify your account.

4. **Configure Twilio Voice IP Service:**

    - Log in to your Twilio account.
    - Navigate to the [Twilio Console](https://www.twilio.com/console).
    - Go to Voice Settings->Settings->General and disable HTTP Basic Authentication for media access.
    - Create a new Voice project and set up the ngrok URL with the webhook route path. Example: `https://5a07-190-92-45-227.ngrok-free.app/api/v1/voice-assistant/incoming-call`.
    - Go to Voice Phone Numbers->Verified Caller IDs and add the user agent's phone number to perform tests.

5. **Clone the repository:**

    ```bash
    git clone git@github.com:LuisaeDev/twilio-voice-assistant.git
    ```

6. **Navigate to the project directory:**

    ```bash
    cd twilio-voice-assistant
    ```

7. **Install Docker on your machine.**

8. **Run the following Docker command to install dependencies using Laravel Sail:**

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
    ```

9. **Run de application**
    ```bash
    ./vendor/bin/sail up -d
    ```

10. **Update the Twilio credentials in the `.env` file:**

    ```env
    TWILIO_SID=your_twilio_sid
    TWILIO_AUTH_TOKEN=your_twilio_auth_token
    TWILIO_PHONE_NUMBER=your_twilio_phone_number
    ```

11. **Modify the database seeder `./database/seeders/DatabaseSeeder.php` to define the demo agent and its phone number to receive the calls.**

12. **Run the migrations and seed the database:**

    ```bash
    ./vendor/bin/sail artisan migrate --seed
    ```

Now, your Twilio Voice Assistant project is set up, and Twilio is configured to forward incoming calls to your local environment through ngrok. Make sure to customize the Twilio credentials and other settings based on your requirements.
