# include .env
# export $(shell sed 's/=.*//' .env)

.DEFAULT_GOAL:= up

up:
	docker-compose  up -d

build:
	docker-compose up -d --build --remove-orphans

down:
	docker-compose down

restart:
	docker-compose down
	docker-compose rm
	make up