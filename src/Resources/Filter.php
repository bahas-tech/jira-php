<?php

declare(strict_types=1);

namespace Jira\Resources;

use Jira\Enums\Transporter\Method;
use Jira\ValueObjects\Transporter\Payload;

class Filter
{
    use Concerns\Transportable;

    /**
     * Create an issue or a sub-task from a JSON representation.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#api/2/filter-createIssue
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
            uri: 'api/2/filter',
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
            uri: 'api/2/filter',
            query: $query
        );

        // @phpstan-ignore-next-line
        return $this->transporter->request(payload: $payload);
    }

    /**
     * Return a full representation of the issue for the given issue key.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#api/2/filter-getIssue
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
            uri: "api/2/filter/$id",
            query: $query,
        );

        // @phpstan-ignore-next-line
        return $this->transporter->request(payload: $payload);
    }

    /**
     * Delete an issue.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#api/2/filter-deleteIssue
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
            uri: "api/2/filter/$id",
            method: Method::DELETE,
            query: $query,
        );

        $this->transporter->request(payload: $payload);
    }

    /**
     * Edit an issue from a JSON representation.
     *
     * @see https://docs.atlassian.com/software/jira/docs/api/REST/8.0.0/#api/2/filter-editIssue
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
            uri: "api/2/filter/$id",
            method: Method::PUT,
            body: $body,
            query: $query,
        );

        $this->transporter->request(payload: $payload);
    }
}
