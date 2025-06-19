<?php

declare(strict_types=1);

namespace Jira\Resources;

use Jira\Enums\Transporter\ContentType;
use Jira\Enums\Transporter\Method;
use Jira\ValueObjects\Transporter\Payload;

class Board
{
    use Concerns\Transportable;

    /**
     * Create an issue or a sub-task from a JSON representation.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#agile/1.0/board-createIssue
     *
     * @param  non-empty-array<array-key, mixed>  $body
     * @return non-empty-array<array-key, mixed>
     *
     * @throws \Jira\Exceptions\ErrorException
     * @throws \Jira\Exceptions\TransporterException
     * @throws \Jira\Exceptions\UnserializableResponse
     * @throws \JsonException
     */
    public function create(array $body): array
    {
        $payload = Payload::create(
            uri: 'agile/1.0/board',
            method: Method::POST,
            body: $body,
        );

        // @phpstan-ignore-next-line
        return $this->transporter->request(payload: $payload);
    }

    /**
     * Get all boards.
     *
     * @see https://developer.atlassian.com/server/jira/platform/rest/v10007/api-group-board/#api-agile-1-0-board-get
     *
     * @param  array<array-key, mixed>  $query
     * @return non-empty-array<array-key, mixed>
     *
     * @throws \Jira\Exceptions\ErrorException
     * @throws \Jira\Exceptions\TransporterException
     * @throws \Jira\Exceptions\UnserializableResponse
     * @throws \JsonException
     */
    public function getAll(array $query = []): array
    {
        $payload = Payload::create(
            uri: 'agile/1.0/board',
            query: $query
        );

        // @phpstan-ignore-next-line
        return $this->transporter->request(payload: $payload);
    }

    /**
     * Return a full representation of the issue for the given issue key.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#agile/1.0/board-getIssue
     *
     * @param  array<array-key, mixed>  $query
     * @return non-empty-array<array-key, mixed>
     *
     * @throws \Jira\Exceptions\ErrorException
     * @throws \Jira\Exceptions\TransporterException
     * @throws \Jira\Exceptions\UnserializableResponse
     * @throws \JsonException
     */
    public function get(int|string $id, array $query = []): array
    {
        $payload = Payload::create(
            uri: "agile/1.0/board/$id",
            query: $query,
        );

        // @phpstan-ignore-next-line
        return $this->transporter->request(payload: $payload);
    }

    /**
     * Delete an issue.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#agile/1.0/board-deleteIssue
     *
     * @param  array<array-key, mixed>  $query
     *
     * @throws \Jira\Exceptions\ErrorException
     * @throws \Jira\Exceptions\TransporterException
     * @throws \Jira\Exceptions\UnserializableResponse
     * @throws \JsonException
     */
    public function delete(int|string $id, array $query = []): void
    {
        $payload = Payload::create(
            uri: "agile/1.0/board/$id",
            method: Method::DELETE,
            query: $query,
        );

        $this->transporter->request(payload: $payload);
    }

    /**
     * Edit an issue from a JSON representation.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#agile/1.0/board-editIssue
     *
     * @param  non-empty-array<array-key, mixed>  $body
     * @param  array<array-key, mixed>  $query
     *
     * @throws \Jira\Exceptions\ErrorException
     * @throws \Jira\Exceptions\TransporterException
     * @throws \Jira\Exceptions\UnserializableResponse
     * @throws \JsonException
     */
    public function edit(int|string $id, array $body, array $query = []): void
    {
        $payload = Payload::create(
            uri: "agile/1.0/board/$id",
            method: Method::PUT,
            body: $body,
            query: $query,
        );

        $this->transporter->request(payload: $payload);
    }
}
