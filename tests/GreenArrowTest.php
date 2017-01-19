<?PHP

namespace Bcismariu\GreenArrow\Tests;

use Bcismariu\GreenArrow\GreenArrow;
use Bcismariu\GreenArrow\Exception;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

class GreenArrowTest extends TestCase
{

    /** @test */
    public function it_instantiates()
    {
        $provider = new GreenArrow($this->client(), [
            'username' => 'username',
            'password' => 'password'
        ]);
        $this->assertInstanceOf(GreenArrow::class, $provider);
    }

    /**
     * @test
     * @expectedException Exception
     */
    public function it_throws_exception()
    {
        $provider = new GreenArrow($this->client(), ['test' => 'nothing here']);
    }

    /**
     * provides a client instance
     * @return Client
     */
    protected function client()
    {
        return new GuzzleAdapter(new Client());
    }
}
