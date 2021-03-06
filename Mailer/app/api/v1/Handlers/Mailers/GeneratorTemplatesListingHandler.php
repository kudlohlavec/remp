<?php

namespace Remp\MailerModule\Api\v1\Handlers\Mailers;

use Remp\MailerModule\Generators\GeneratorFactory;
use Remp\MailerModule\Repository\SourceTemplatesRepository;
use Tomaj\NetteApi\Handlers\BaseHandler;
use Tomaj\NetteApi\Params\InputParam;
use Tomaj\NetteApi\Response\JsonApiResponse;

class GeneratorTemplatesListingHandler extends BaseHandler
{
    private $generatorFactory;

    private $sourceTemplatesRepository;

    public function __construct(GeneratorFactory $generatorFactory, SourceTemplatesRepository $sourceTemplatesRepository)
    {
        parent::__construct();
        $this->sourceTemplatesRepository = $sourceTemplatesRepository;
        $this->generatorFactory = $generatorFactory;
    }

    public function params()
    {
        return [
            new InputParam(InputParam::TYPE_GET, 'generator'),
        ];
    }

    public function handle($params)
    {
        $generator = $params['generator'];
        if (!$generator) {
            $generator = $this->generatorFactory->keys();
        }
        $results = $this->sourceTemplatesRepository->getTable()
            ->where(['generator' => $generator])
            ->select('id,title')->fetchAll();

        $output = [];
        foreach ($results as $row) {
            $item = new \stdClass();
            $item->id = $row->id;
            $item->title = $row->title;
            $output[] = $item;
        }

        return new JsonApiResponse(200, ['status' => 'ok', 'data' => $output]);
    }
}
