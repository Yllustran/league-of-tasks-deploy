            docker context create league-of-tasks --docker "host=ssh://root@168.231.80.178"
            docker context use league-of-tasks
        publish:
            docker context use league-of-tasks
            docker-compose down --rmi all
            docker compose -f ./docker-stack.yml up -d
        publish-data:
            docker exec $(shell docker ps --filter "name=^pokedex-laravel-docker" --quiet) bash -c "php artisan migrate"
            docker exec $(shell docker ps --filter "name=^pokedex-laravel-docker" --quiet) bash -c "php artisan db:seed"