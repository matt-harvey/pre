# Pre

## What problem does this solve?

I created this very basic tool as a way to save myself typing the same Docker-related prefixes
again and again. For example:

```
docker exec -it <some-container-name> <something-to-do-inside-the-container>
```

The part before `<something-to-do-inside-the-container>` is:

* Often quite verbose
* Varies from project to project
* Is the same most of the time when I'm running commands within a particular project

I wanted a way to avoid repetitively typing the same thing while also being able to
vary the thing I'm avoiding repetitively typing, on a per-project basis. Simple shell
aliases didn't quite meet this requirement.

## How does `pre` solve this problem?

You write your prefix as the single line of content in a file called `.pre` that lives inside your project.

When you run `pre <args...>` from inside the directory that the `.pre` file lives in, it will
automatically prefix that line to `<args...>`, and then run the whole thing as one command.

_For example:_

* In directory A, I place a file `.pre` containing just the line `docker exec -it my-app`
* While in directory A, I run (for example) the command `pre php artisan test`
* It is as if I had run: `docker exec -it my-app php artisan test`

## Installing `pre`

You need PHP installed. Any recent-ish version should do.

`pre` comes in one small file with no dependencies. Just copy the file `pre.php` to somewhere
in your path e.g. `/usr/local/bin/pre`, and make it executable (`chmod +x`).
