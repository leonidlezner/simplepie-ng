<?php
/**
 * Copyright (c) 2017–2019 Ryan Parman <http://ryanparman.com>.
 * Copyright (c) 2017–2019 Contributors.
 *
 * http://opensource.org/licenses/Apache2.0
 */

declare(strict_types=1);

namespace SimplePie\Test\Integration\WellFormed\Atom;

use SimplePie\Enum\Serialization;
use SimplePie\Test\Integration\AbstractTestCase;

class FeedRightsTest extends AbstractTestCase
{
    protected function setUp(): void
    {
        $this->simplepie = $this->getSimplePie();
    }

    public function testRights(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('Example Atom', (string) $feed->getRights());
    }

    public function testEscapedMarkup(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_escaped_markup.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('Example <b>Atom</b>', (string) $feed->getRights());
        static::assertEquals(Serialization::HTML, $feed->getRights()->getSerialization());
    }

    public function testInlineMarkup(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_inline_markup.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('Example <b>Atom</b>', (string) $feed->getRights());
        static::assertEquals(Serialization::XHTML, $feed->getRights()->getSerialization());
    }

    public function testInlineMarkup2(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_inline_markup_2.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('History of the &lt;blink&gt; tag', (string) $feed->getRights());
        static::assertEquals(Serialization::XHTML, $feed->getRights()->getSerialization());
    }

    public function testTextPlain(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_text_plain.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('Example Atom', (string) $feed->getRights());
        static::assertEquals(Serialization::TEXT, $feed->getRights()->getSerialization());
    }

    public function testBase64(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_base64.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('Example <b>Atom</b>', (string) $feed->getRights());
        static::assertEquals(Serialization::TEXT, $feed->getRights()->getSerialization());
    }

    public function testBase642(): void
    {
        $stream = $this->getFeed('/wellformed/atom10/feed_rights_base64_2.xml');
        $parser = $this->simplepie->parseXml($stream);
        $feed   = $parser->getFeed();

        static::assertEquals('<p>History of the &lt;blink&gt; tag</p>', (string) $feed->getRights());
        static::assertEquals(Serialization::TEXT, $feed->getRights()->getSerialization());
    }
}
