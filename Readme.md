# Rover PHPUNIT Recruitment Test

Emulating Commands provided to a Mars Rover as the recruitment states use.

# How to Run:

1. Copy the `.env.dist` into `.env`.
2. Set the values into the `.env` as comments show.
3. Run `docker-compose up -d`.
4. Launch a Bash shell via `docker-compose exec -ti php bash`.
5. Launch the unit tests via `./vendor/bin/phpunit`.

If classes are not being autoloaded then run first: `composer dump-autoload -o` inside the image's shell.