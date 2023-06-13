<?php

namespace sdks\openapi\kuaishou;

interface KuaishouRequestInterface
{
    public function apiName(): string;

    public function getApiParas(): array;

    public function getApiMethod(): string;
}
