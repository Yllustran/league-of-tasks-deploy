init-publish:
	docker context create league-of-tasks --docker "host=ssh://root@168.231.80.178"
	docker context use league-of-tasks
publish:
	docker context use league-of-tasks
	docker-compose down --rmi all --remove-orphans
	docker system prune -a
	docker login https://ghcr.io
	docker compose -f ./docker-stack.yml up -d
publish-data:
    docker exec $(docker ps --filter "name=league-of-tasks-deploy-laravel-docker-1" -q) sh -c "php artisan migrate:fresh --seed"