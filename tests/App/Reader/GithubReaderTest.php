<?php

namespace App\Reader;

use App\Popo\Hit;
use App\Popo\Repo;
use App\Popo\Result;
use App\Request\RequestParameters;
use App\Retriever\RetrieverInterface;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\Retriever\GithubRetriever
 */
final class GithubReaderTest extends TestCase
{
    /**
     * @dataProvider dpFetch
     */
    public function testHandle(string $repo, Result $expected): void
    {
        $params = new RequestParameters('path');

        /** @var RetrieverInterface|MockObject $retriever */
        $retriever = $this->createMock(RetrieverInterface::class);
        $retriever->expects($this->once())->method('setup')->with($params)->willReturnSelf();
        $retriever->expects($this->once())->method('fetch')->willReturn($repo);

        $reader = new GithubReader();
        $reader->setRetriever($retriever);

        $actual = $reader->handle($params);

        $this->assertEquals($expected, $actual);
    }

    public function dpFetch(): array
    {
        return [
            [$this->getUserRepo(), $this->getUserResult()],
            [$this->getCodeRepo(), $this->getCodeResult()]
        ];
    }

    private function getUserRepo(): string
    {
        return '[
  {
    "id": 340935513,
    "node_id": "MDEwOlJlcG9zaXRvcnkzNDA5MzU1MTM=",
    "name": "kenteken-app",
    "full_name": "bveenhof/kenteken-app",
    "private": false,
    "owner": {
      "login": "bveenhof",
      "id": 8816811,
      "node_id": "MDQ6VXNlcjg4MTY4MTE=",
      "avatar_url": "https://avatars.githubusercontent.com/u/8816811?v=4",
      "gravatar_id": "",
      "url": "https://api.github.com/users/bveenhof",
      "html_url": "https://github.com/bveenhof",
      "followers_url": "https://api.github.com/users/bveenhof/followers",
      "following_url": "https://api.github.com/users/bveenhof/following{/other_user}",
      "gists_url": "https://api.github.com/users/bveenhof/gists{/gist_id}",
      "starred_url": "https://api.github.com/users/bveenhof/starred{/owner}{/repo}",
      "subscriptions_url": "https://api.github.com/users/bveenhof/subscriptions",
      "organizations_url": "https://api.github.com/users/bveenhof/orgs",
      "repos_url": "https://api.github.com/users/bveenhof/repos",
      "events_url": "https://api.github.com/users/bveenhof/events{/privacy}",
      "received_events_url": "https://api.github.com/users/bveenhof/received_events",
      "type": "User",
      "site_admin": false
    },
    "html_url": "https://github.com/bveenhof/kenteken-app",
    "description": "Nederlandse kentekens checken",
    "fork": false,
    "url": "https://api.github.com/repos/bveenhof/kenteken-app",
    "forks_url": "https://api.github.com/repos/bveenhof/kenteken-app/forks",
    "keys_url": "https://api.github.com/repos/bveenhof/kenteken-app/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/bveenhof/kenteken-app/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/bveenhof/kenteken-app/teams",
    "hooks_url": "https://api.github.com/repos/bveenhof/kenteken-app/hooks",
    "issue_events_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues/events{/number}",
    "events_url": "https://api.github.com/repos/bveenhof/kenteken-app/events",
    "assignees_url": "https://api.github.com/repos/bveenhof/kenteken-app/assignees{/user}",
    "branches_url": "https://api.github.com/repos/bveenhof/kenteken-app/branches{/branch}",
    "tags_url": "https://api.github.com/repos/bveenhof/kenteken-app/tags",
    "blobs_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/bveenhof/kenteken-app/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/bveenhof/kenteken-app/languages",
    "stargazers_url": "https://api.github.com/repos/bveenhof/kenteken-app/stargazers",
    "contributors_url": "https://api.github.com/repos/bveenhof/kenteken-app/contributors",
    "subscribers_url": "https://api.github.com/repos/bveenhof/kenteken-app/subscribers",
    "subscription_url": "https://api.github.com/repos/bveenhof/kenteken-app/subscription",
    "commits_url": "https://api.github.com/repos/bveenhof/kenteken-app/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/bveenhof/kenteken-app/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/bveenhof/kenteken-app/contents/{+path}",
    "compare_url": "https://api.github.com/repos/bveenhof/kenteken-app/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/bveenhof/kenteken-app/merges",
    "archive_url": "https://api.github.com/repos/bveenhof/kenteken-app/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/bveenhof/kenteken-app/downloads",
    "issues_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues{/number}",
    "pulls_url": "https://api.github.com/repos/bveenhof/kenteken-app/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/bveenhof/kenteken-app/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/bveenhof/kenteken-app/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/bveenhof/kenteken-app/labels{/name}",
    "releases_url": "https://api.github.com/repos/bveenhof/kenteken-app/releases{/id}",
    "deployments_url": "https://api.github.com/repos/bveenhof/kenteken-app/deployments",
    "created_at": "2021-02-21T15:33:42Z",
    "updated_at": "2021-02-21T15:36:19Z",
    "pushed_at": "2021-02-21T15:36:18Z",
    "git_url": "git://github.com/bveenhof/kenteken-app.git",
    "ssh_url": "git@github.com:bveenhof/kenteken-app.git",
    "clone_url": "https://github.com/bveenhof/kenteken-app.git",
    "svn_url": "https://github.com/bveenhof/kenteken-app",
    "homepage": null,
    "size": 0,
    "stargazers_count": 0,
    "watchers_count": 0,
    "language": null,
    "has_issues": true,
    "has_projects": true,
    "has_downloads": true,
    "has_wiki": true,
    "has_pages": false,
    "forks_count": 0,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 0,
    "license": null,
    "forks": 0,
    "open_issues": 0,
    "watchers": 0,
    "default_branch": "master"
  },
  {
    "id": 46234209,
    "node_id": "MDEwOlJlcG9zaXRvcnk0NjIzNDIwOQ==",
    "name": "portfolio",
    "full_name": "bveenhof/portfolio",
    "private": false,
    "owner": {
      "login": "bveenhof",
      "id": 8816811,
      "node_id": "MDQ6VXNlcjg4MTY4MTE=",
      "avatar_url": "https://avatars.githubusercontent.com/u/8816811?v=4",
      "gravatar_id": "",
      "url": "https://api.github.com/users/bveenhof",
      "html_url": "https://github.com/bveenhof",
      "followers_url": "https://api.github.com/users/bveenhof/followers",
      "following_url": "https://api.github.com/users/bveenhof/following{/other_user}",
      "gists_url": "https://api.github.com/users/bveenhof/gists{/gist_id}",
      "starred_url": "https://api.github.com/users/bveenhof/starred{/owner}{/repo}",
      "subscriptions_url": "https://api.github.com/users/bveenhof/subscriptions",
      "organizations_url": "https://api.github.com/users/bveenhof/orgs",
      "repos_url": "https://api.github.com/users/bveenhof/repos",
      "events_url": "https://api.github.com/users/bveenhof/events{/privacy}",
      "received_events_url": "https://api.github.com/users/bveenhof/received_events",
      "type": "User",
      "site_admin": false
    },
    "html_url": "https://github.com/bveenhof/portfolio",
    "description": null,
    "fork": false,
    "url": "https://api.github.com/repos/bveenhof/portfolio",
    "forks_url": "https://api.github.com/repos/bveenhof/portfolio/forks",
    "keys_url": "https://api.github.com/repos/bveenhof/portfolio/keys{/key_id}",
    "collaborators_url": "https://api.github.com/repos/bveenhof/portfolio/collaborators{/collaborator}",
    "teams_url": "https://api.github.com/repos/bveenhof/portfolio/teams",
    "hooks_url": "https://api.github.com/repos/bveenhof/portfolio/hooks",
    "issue_events_url": "https://api.github.com/repos/bveenhof/portfolio/issues/events{/number}",
    "events_url": "https://api.github.com/repos/bveenhof/portfolio/events",
    "assignees_url": "https://api.github.com/repos/bveenhof/portfolio/assignees{/user}",
    "branches_url": "https://api.github.com/repos/bveenhof/portfolio/branches{/branch}",
    "tags_url": "https://api.github.com/repos/bveenhof/portfolio/tags",
    "blobs_url": "https://api.github.com/repos/bveenhof/portfolio/git/blobs{/sha}",
    "git_tags_url": "https://api.github.com/repos/bveenhof/portfolio/git/tags{/sha}",
    "git_refs_url": "https://api.github.com/repos/bveenhof/portfolio/git/refs{/sha}",
    "trees_url": "https://api.github.com/repos/bveenhof/portfolio/git/trees{/sha}",
    "statuses_url": "https://api.github.com/repos/bveenhof/portfolio/statuses/{sha}",
    "languages_url": "https://api.github.com/repos/bveenhof/portfolio/languages",
    "stargazers_url": "https://api.github.com/repos/bveenhof/portfolio/stargazers",
    "contributors_url": "https://api.github.com/repos/bveenhof/portfolio/contributors",
    "subscribers_url": "https://api.github.com/repos/bveenhof/portfolio/subscribers",
    "subscription_url": "https://api.github.com/repos/bveenhof/portfolio/subscription",
    "commits_url": "https://api.github.com/repos/bveenhof/portfolio/commits{/sha}",
    "git_commits_url": "https://api.github.com/repos/bveenhof/portfolio/git/commits{/sha}",
    "comments_url": "https://api.github.com/repos/bveenhof/portfolio/comments{/number}",
    "issue_comment_url": "https://api.github.com/repos/bveenhof/portfolio/issues/comments{/number}",
    "contents_url": "https://api.github.com/repos/bveenhof/portfolio/contents/{+path}",
    "compare_url": "https://api.github.com/repos/bveenhof/portfolio/compare/{base}...{head}",
    "merges_url": "https://api.github.com/repos/bveenhof/portfolio/merges",
    "archive_url": "https://api.github.com/repos/bveenhof/portfolio/{archive_format}{/ref}",
    "downloads_url": "https://api.github.com/repos/bveenhof/portfolio/downloads",
    "issues_url": "https://api.github.com/repos/bveenhof/portfolio/issues{/number}",
    "pulls_url": "https://api.github.com/repos/bveenhof/portfolio/pulls{/number}",
    "milestones_url": "https://api.github.com/repos/bveenhof/portfolio/milestones{/number}",
    "notifications_url": "https://api.github.com/repos/bveenhof/portfolio/notifications{?since,all,participating}",
    "labels_url": "https://api.github.com/repos/bveenhof/portfolio/labels{/name}",
    "releases_url": "https://api.github.com/repos/bveenhof/portfolio/releases{/id}",
    "deployments_url": "https://api.github.com/repos/bveenhof/portfolio/deployments",
    "created_at": "2015-11-15T20:21:27Z",
    "updated_at": "2015-11-15T20:21:27Z",
    "pushed_at": "2015-11-15T20:21:27Z",
    "git_url": "git://github.com/bveenhof/portfolio.git",
    "ssh_url": "git@github.com:bveenhof/portfolio.git",
    "clone_url": "https://github.com/bveenhof/portfolio.git",
    "svn_url": "https://github.com/bveenhof/portfolio",
    "homepage": null,
    "size": 0,
    "stargazers_count": 0,
    "watchers_count": 0,
    "language": null,
    "has_issues": true,
    "has_projects": true,
    "has_downloads": true,
    "has_wiki": true,
    "has_pages": false,
    "forks_count": 0,
    "mirror_url": null,
    "archived": false,
    "disabled": false,
    "open_issues_count": 0,
    "license": null,
    "forks": 0,
    "open_issues": 0,
    "watchers": 0,
    "default_branch": "master"
  }
]
';
    }

    private function getCodeRepo(): string
    {
        return '{
  "total_count": 1,
  "incomplete_results": false,
  "items": [
    {
      "name": "README.md",
      "path": "README.md",
      "sha": "6cb3a4edae3ac74602c2c3d8ea81bdb0eb050f4b",
      "url": "https://api.github.com/repositories/340935513/contents/README.md?ref=818ee2b9c0dc09b49d74277120b6f23a8fdc992f",
      "git_url": "https://api.github.com/repositories/340935513/git/blobs/6cb3a4edae3ac74602c2c3d8ea81bdb0eb050f4b",
      "html_url": "https://github.com/bveenhof/kenteken-app/blob/818ee2b9c0dc09b49d74277120b6f23a8fdc992f/README.md",
      "repository": {
        "id": 340935513,
        "node_id": "MDEwOlJlcG9zaXRvcnkzNDA5MzU1MTM=",
        "name": "kenteken-app",
        "full_name": "bveenhof/kenteken-app",
        "private": false,
        "owner": {
          "login": "bveenhof",
          "id": 8816811,
          "node_id": "MDQ6VXNlcjg4MTY4MTE=",
          "avatar_url": "https://avatars.githubusercontent.com/u/8816811?v=4",
          "gravatar_id": "",
          "url": "https://api.github.com/users/bveenhof",
          "html_url": "https://github.com/bveenhof",
          "followers_url": "https://api.github.com/users/bveenhof/followers",
          "following_url": "https://api.github.com/users/bveenhof/following{/other_user}",
          "gists_url": "https://api.github.com/users/bveenhof/gists{/gist_id}",
          "starred_url": "https://api.github.com/users/bveenhof/starred{/owner}{/repo}",
          "subscriptions_url": "https://api.github.com/users/bveenhof/subscriptions",
          "organizations_url": "https://api.github.com/users/bveenhof/orgs",
          "repos_url": "https://api.github.com/users/bveenhof/repos",
          "events_url": "https://api.github.com/users/bveenhof/events{/privacy}",
          "received_events_url": "https://api.github.com/users/bveenhof/received_events",
          "type": "User",
          "site_admin": false
        },
        "html_url": "https://github.com/bveenhof/kenteken-app",
        "description": "Nederlandse kentekens checken",
        "fork": false,
        "url": "https://api.github.com/repos/bveenhof/kenteken-app",
        "forks_url": "https://api.github.com/repos/bveenhof/kenteken-app/forks",
        "keys_url": "https://api.github.com/repos/bveenhof/kenteken-app/keys{/key_id}",
        "collaborators_url": "https://api.github.com/repos/bveenhof/kenteken-app/collaborators{/collaborator}",
        "teams_url": "https://api.github.com/repos/bveenhof/kenteken-app/teams",
        "hooks_url": "https://api.github.com/repos/bveenhof/kenteken-app/hooks",
        "issue_events_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues/events{/number}",
        "events_url": "https://api.github.com/repos/bveenhof/kenteken-app/events",
        "assignees_url": "https://api.github.com/repos/bveenhof/kenteken-app/assignees{/user}",
        "branches_url": "https://api.github.com/repos/bveenhof/kenteken-app/branches{/branch}",
        "tags_url": "https://api.github.com/repos/bveenhof/kenteken-app/tags",
        "blobs_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/blobs{/sha}",
        "git_tags_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/tags{/sha}",
        "git_refs_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/refs{/sha}",
        "trees_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/trees{/sha}",
        "statuses_url": "https://api.github.com/repos/bveenhof/kenteken-app/statuses/{sha}",
        "languages_url": "https://api.github.com/repos/bveenhof/kenteken-app/languages",
        "stargazers_url": "https://api.github.com/repos/bveenhof/kenteken-app/stargazers",
        "contributors_url": "https://api.github.com/repos/bveenhof/kenteken-app/contributors",
        "subscribers_url": "https://api.github.com/repos/bveenhof/kenteken-app/subscribers",
        "subscription_url": "https://api.github.com/repos/bveenhof/kenteken-app/subscription",
        "commits_url": "https://api.github.com/repos/bveenhof/kenteken-app/commits{/sha}",
        "git_commits_url": "https://api.github.com/repos/bveenhof/kenteken-app/git/commits{/sha}",
        "comments_url": "https://api.github.com/repos/bveenhof/kenteken-app/comments{/number}",
        "issue_comment_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues/comments{/number}",
        "contents_url": "https://api.github.com/repos/bveenhof/kenteken-app/contents/{+path}",
        "compare_url": "https://api.github.com/repos/bveenhof/kenteken-app/compare/{base}...{head}",
        "merges_url": "https://api.github.com/repos/bveenhof/kenteken-app/merges",
        "archive_url": "https://api.github.com/repos/bveenhof/kenteken-app/{archive_format}{/ref}",
        "downloads_url": "https://api.github.com/repos/bveenhof/kenteken-app/downloads",
        "issues_url": "https://api.github.com/repos/bveenhof/kenteken-app/issues{/number}",
        "pulls_url": "https://api.github.com/repos/bveenhof/kenteken-app/pulls{/number}",
        "milestones_url": "https://api.github.com/repos/bveenhof/kenteken-app/milestones{/number}",
        "notifications_url": "https://api.github.com/repos/bveenhof/kenteken-app/notifications{?since,all,participating}",
        "labels_url": "https://api.github.com/repos/bveenhof/kenteken-app/labels{/name}",
        "releases_url": "https://api.github.com/repos/bveenhof/kenteken-app/releases{/id}",
        "deployments_url": "https://api.github.com/repos/bveenhof/kenteken-app/deployments"
      },
      "score": 1.0
    }
  ]
}
';
    }

    private function getUserResult(): Result
    {
        $r = new Result('github');
        $r->count = 2;
        $r->repos = [
            new Repo('kenteken-app', 'Nederlandse kentekens checken', 'https://github.com/bveenhof/kenteken-app'),
            new Repo('portfolio', '', 'https://github.com/bveenhof/portfolio'),
        ];

        return $r;
    }

    private function getCodeResult(): Result
    {
        $r = new Result('github');
        $r->count = 1;
        $r->hits = [
            new Hit(
                'README.md',
                'README.md',
                'https://github.com/bveenhof/kenteken-app/blob/818ee2b9c0dc09b49d74277120b6f23a8fdc992f/README.md',
                    new Repo('kenteken-app', 'Nederlandse kentekens checken', 'https://github.com/bveenhof/kenteken-app'),
            ),
        ];


        return $r;
    }
}
