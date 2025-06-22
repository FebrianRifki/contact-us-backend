<?php

namespace App\Repositories;

interface EmailRepositoryInterface
{
    public function getall(): array;
    public function getById(int $id): array;
    public function send(array $data): array;
    public function delete(int $id): array;
    public function update(int $id, array $data): array;
    public function reply(int $id, array $data): array;
    public function getReplyMessage(int $id): array;

}