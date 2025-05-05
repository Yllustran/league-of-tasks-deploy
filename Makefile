dev:
	make -j 2 artisan-serve vuejs
seed:
	cd Cursus-api && php artisan migrate:fresh --seed
artisan-serve:
	cd Cursus-api && php artisan serve
vuejs:
	cd Cursus-spa && npm run dev
test:
	cd Cursus-api && php artisan migrate:fresh --seed
	cd ..
	cd Tests-api && npm run test
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
    docker exec $(docker ps --filter "name=leagueoftasks-laravel-docker" -q) sh -c "php artisan migrate:fresh --seed"