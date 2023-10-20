<?php

namespace App\Test\Controller;

use App\Entity\WeeklyMenu;
use App\Repository\WeeklyMenuRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WeeklyMenuControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private WeeklyMenuRepository $repository;
    private string $path = '/weekly/menu/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(WeeklyMenu::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('WeeklyMenu index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'weekly_menu[title]' => 'Testing',
            'weekly_menu[breakfast]' => 'Testing',
            'weekly_menu[firstSnack]' => 'Testing',
            'weekly_menu[lunch]' => 'Testing',
            'weekly_menu[secondSnack]' => 'Testing',
            'weekly_menu[dinner]' => 'Testing',
        ]);

        self::assertResponseRedirects('/weekly/menu/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new WeeklyMenu();
        $fixture->setTitle('My Title');
        $fixture->setBreakfast('My Title');
        $fixture->setFirstSnack('My Title');
        $fixture->setLunch('My Title');
        $fixture->setSecondSnack('My Title');
        $fixture->setDinner('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('WeeklyMenu');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new WeeklyMenu();
        $fixture->setTitle('My Title');
        $fixture->setBreakfast('My Title');
        $fixture->setFirstSnack('My Title');
        $fixture->setLunch('My Title');
        $fixture->setSecondSnack('My Title');
        $fixture->setDinner('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'weekly_menu[title]' => 'Something New',
            'weekly_menu[breakfast]' => 'Something New',
            'weekly_menu[firstSnack]' => 'Something New',
            'weekly_menu[lunch]' => 'Something New',
            'weekly_menu[secondSnack]' => 'Something New',
            'weekly_menu[dinner]' => 'Something New',
        ]);

        self::assertResponseRedirects('/weekly/menu/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getBreakfast());
        self::assertSame('Something New', $fixture[0]->getFirstSnack());
        self::assertSame('Something New', $fixture[0]->getLunch());
        self::assertSame('Something New', $fixture[0]->getSecondSnack());
        self::assertSame('Something New', $fixture[0]->getDinner());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new WeeklyMenu();
        $fixture->setTitle('My Title');
        $fixture->setBreakfast('My Title');
        $fixture->setFirstSnack('My Title');
        $fixture->setLunch('My Title');
        $fixture->setSecondSnack('My Title');
        $fixture->setDinner('My Title');

        $this->repository->save($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/weekly/menu/');
    }
}