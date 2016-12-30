# MVlabs Prooph Skeleton

A simple skeleton application to start with Prooph ES/CQRS applications

## Installation

Just fire up `docker-compose` with

```bash
docker-compose up
```

## Dependencies

Manage dependencies with composer using

```bash
bin/composer
```

## Migrations

Run migrations using

```bash
bin/migrations
```

If that doesn't work, the network setting in the script needs to be fixed

## Tests

Run the tests with

```bash
bin/test
```

## Async

The `data` folder must be writable.

Remember to run the `bin/consumer` to consume the queued commands

