<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Client;
use App\Service\Weather\WeatherApiService;
use App\Service\Weather\OpenWeatherApiService;

/**
 * Weather Controller
 *
 * @method \App\Model\Entity\Weather[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class WeatherController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $weatherService = new WeatherApiService(new OpenWeatherApiService(new Client()));
        $weather = $weatherService->getWeather('https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99');

        $this->set([
            'weather' => $weather,
        ]);
    }

    /**
     * View method
     *
     * @param string|null $id Weather id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $weather = $this->Weather->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('weather'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $weather = $this->Weather->newEmptyEntity();
        if ($this->request->is('post')) {
            $weather = $this->Weather->patchEntity($weather, $this->request->getData());
            if ($this->Weather->save($weather)) {
                $this->Flash->success(__('The weather has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weather could not be saved. Please, try again.'));
        }
        $this->set(compact('weather'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Weather id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $weather = $this->Weather->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $weather = $this->Weather->patchEntity($weather, $this->request->getData());
            if ($this->Weather->save($weather)) {
                $this->Flash->success(__('The weather has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The weather could not be saved. Please, try again.'));
        }
        $this->set(compact('weather'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Weather id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $weather = $this->Weather->get($id);
        if ($this->Weather->delete($weather)) {
            $this->Flash->success(__('The weather has been deleted.'));
        } else {
            $this->Flash->error(__('The weather could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
