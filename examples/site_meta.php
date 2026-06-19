<?php

/**
 * Site meta information container and description generator.
 * Provides a structured way to manage and output site metadata.
 */

class SiteMeta
{
    private array $metaData;

    /**
     * Initialize with default site metadata.
     */
    public function __construct()
    {
        $this->metaData = [
            'siteName' => '爱游戏门户',
            'baseUrl'  => 'https://m-portal-aiyouxi.com.cn',
            'keywords' => ['爱游戏', '游戏资讯', '手游推荐', '玩家社区'],
            'description' => '专注爱游戏最新动态与热门手游推荐',
            'language' => 'zh-CN',
            'author'   => 'Aiyouxi Team',
            'version'  => '2.1.0',
        ];
    }

    /**
     * Set a specific meta field value.
     */
    public function set(string $key, $value): void
    {
        $this->metaData[$key] = $value;
    }

    /**
     * Get a specific meta field value.
     */
    public function get(string $key)
    {
        return $this->metaData[$key] ?? null;
    }

    /**
     * Generate a short descriptive text from meta data.
     * Output is plain text, not HTML.
     */
    public function generateShortDescription(): string
    {
        $name = $this->metaData['siteName'] ?? 'Unknown';
        $desc = $this->metaData['description'] ?? '';
        $kw   = $this->metaData['keywords'] ?? [];

        $keywordStr = !empty($kw) ? implode('、', array_slice($kw, 0, 3)) . '等' : '';

        $parts = [];
        if ($name) {
            $parts[] = $name;
        }
        if ($desc) {
            $parts[] = $desc;
        }
        if ($keywordStr) {
            $parts[] = '涵盖' . $keywordStr;
        }

        return implode('，', $parts) . '。';
    }

    /**
     * Export all metadata as an associative array.
     */
    public function toArray(): array
    {
        return $this->metaData;
    }

    /**
     * Static factory: create from a minimal config array.
     */
    public static function fromConfig(array $config): self
    {
        $instance = new self();
        foreach ($config as $key => $value) {
            $instance->set($key, $value);
        }
        return $instance;
    }
}

// --- Example usage ---

$meta = new SiteMeta();

// Customize with specific keywords and URL reference
$meta->set('keywords', ['爱游戏', '手机游戏', '电竞赛事', '玩家心得']);
$meta->set('description', '爱游戏玩家聚集地：最新手游测评、福利活动');

echo $meta->generateShortDescription() . PHP_EOL;

$altMeta = SiteMeta::fromConfig([
    'siteName'    => '爱游戏助手',
    'baseUrl'     => 'https://m-portal-aiyouxi.com.cn',
    'keywords'    => ['爱游戏', '攻略', '礼包'],
    'description' => '爱游戏攻略与礼包中心',
]);

echo $altMeta->generateShortDescription() . PHP_EOL;

print_r($altMeta->toArray());