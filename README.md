## DTR @ LGU Nabua
A web portal hooked into the DTR machine of LGU Nabua that provides DTR viewing and monitoring to employees.

### Development Environment
* PHP `^8.0`
* Node `^16.14`
* Composer `^2.2.7`

### Development Setup
1. Clone or download this repository.
2. Open the project directory and copy `.env-example` to `.env` in the root directory.
3. Get a [reCAPTCHA v3](https://www.google.com/recaptcha) config and write it on your `.env` file.
   ```dotenv
   reCAPTCHA_v3_SITE_KEY=your_recaptcha_site_key
   reCAPTCHA_v3_SECRET=your_recaptcha_secret_key
   ```
   <sup>- add `127.0.0.1` or `localhost` to your reCAPTCHA domains.</sup>
4. Create a MySQL database named `dtr_lgu_nabua`.
5. Open cloned directory in terminal then run the following commands in order:

    *Install backend dependencies:*
    ```composer log
    composer update
    ```
   
    *Install frontend dependencies:*
    ```composer log
    npm install
    ```
   
    *Generate Application Key:*
    ```composer log
    php artisan key:generate
    ```
   
    *Migrate database tables:*
    ```composer log
    php artisan migrate
    ```
   
    *Spin a local dev server:*
    ```composer log
    php artisan serve
    ```
   
   *Compile and run frontend in different terminal session:*
    ```composer log
    npm run watch
    ```
   
### Execution
Access the local development server and use this dummy account code:
```
test
```
   
