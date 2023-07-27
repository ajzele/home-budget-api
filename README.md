# HOME BUDGET ❤ API Platform

## Useful commands:

To re-run DB-Entity sync on DB-Entity changes, run:

`bin/console make:migration`
`bin/console doctrine:migrations:migrate`

### Factory creation

`bin/console make:factory`

### Fixture creation

Generation itself is done via `php bin/console make:fixtures TodoFixtures`.

Fixtures end up in `src/DataFixtures` directory.

To load the fixtures into database `php bin/console doctrine:fixtures:load`.