<?php

namespace Ofey\Logan22\model\item;

use DateTime;
use Ofey\Logan22\component\fileSys\fileSys;
use Ofey\Logan22\component\image\client_icon;
use Ofey\Logan22\component\time\time;

class item
{
    private int $id = 0;

    private int $enchant = 0;

    private string|DateTime|null $date = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): item
    {
        $this->id = $id;
        return $this;
    }

    public function getItemId(): int
    {
        return $this->itemId;
    }

    public function setItemId(int $itemId): item
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): item
    {
        $this->count = $count;
        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): item
    {
        $this->cost = $cost;
        return $this;
    }

    public function getServerId(): int
    {
        return $this->serverId;
    }

    private int $itemId = 0;
    private int $count = 0;
    private int $cost = 0;

    private ?string $icon;
    private ?string $itemName;
    private ?string $add_name;
    private ?string $description;

    public function getAddName(): ?string
    {
        return $this->add_name;
    }

    public function setAddName(?string $add_name): item
    {
        $this->add_name = $add_name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): item
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(bool $price): item
    {
        $this->price = $price;
        return $this;
    }

    public function getIsTradable(): ?string
    {
        return $this->is_tradable;
    }

    public function setIsTradable(bool $is_tradable): item
    {
        $this->is_tradable = $is_tradable;
        return $this;
    }

    public function getIsDropable(): ?string
    {
        return $this->is_dropable;
    }

    public function setIsDropable(bool $is_dropable): item
    {
        $this->is_dropable = $is_dropable;
        return $this;
    }

    public function getIsSellable(): ?string
    {
        return $this->is_sellable;
    }

    public function setIsSellable(bool $is_sellable): item
    {
        $this->is_sellable = $is_sellable;
        return $this;
    }

    public function getIsDepositable(): ?string
    {
        return $this->is_depositable;
    }

    public function setIsDepositable(bool $is_depositable): item
    {
        $this->is_depositable = $is_depositable;
        return $this;
    }

    public function getIsStackable(): ?string
    {
        return $this->is_stackable;
    }

    public function setIsStackable(bool $is_stackable): item
    {
        $this->is_stackable = $is_stackable;
        return $this;
    }

    private ?int $price;
    private bool $is_tradable;
    private bool $is_dropable;
    private ?string $type;
    private bool $is_sellable;
    private bool $is_depositable;
    private bool $is_stackable;
    private ?string $crystal_type = null;

    public function getCrystalType(): ?string
    {
        return $this->crystal_type;
    }

    public function setCrystalType(?string $crystal_type): void
    {
        $this->crystal_type = $crystal_type;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): void
    {
        $this->icon = self::icon($icon);
    }

    public function getItemName(): ?string
    {
        return $this->itemName;
    }

    public function setItemName(?string $itemName): void
    {
        $this->itemName = $itemName;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    public static function icon($fileIcon = null, $object = "icon")
    {
        if ($fileIcon != null && pathinfo($fileIcon, PATHINFO_EXTENSION) === 'webp') {
            $fileIcon = pathinfo($fileIcon, PATHINFO_FILENAME);
        }
        return file_exists(fileSys::get_dir("/uploads/images/{$object}/" . $fileIcon . ".webp")) && $fileIcon != null ? fileSys::localdir("/uploads/images/{$object}/" . $fileIcon . ".webp") : fileSys::localdir("/uploads/images/icon/NOIMAGE.webp");
    }

    private static array $arrItems = [];

    public static function getItem($id): ?item
    {
        if (isset(self::$arrItems[$id])) {
            return self::$arrItems[$id];
        }
        $file = client_icon::includeFileByRange($id);
        if (!$file) {
            return null;
        }
        $itemArr = require $file;
        if (isset($itemArr[$id])) {
            $item = $itemArr[$id];
            $itemObject = new item();
            $itemObject->setItemId($id);
            $itemObject->setType($item['type']);
            $itemObject->setItemName($item['name']);
            $itemObject->setAddName($item['add_name']);
            $itemObject->setDescription($item['description']);
            $itemObject->setCrystalType($item['crystal_type'] ?? null);
            $itemObject->setIsDropable($item['is_dropable'] ?? false);
            $itemObject->setIsSellable($item['is_sellable'] ?? false);
            $itemObject->setIsTradable($item['is_tradable'] ?? false);
            $itemObject->setIsStackable($item['is_stackable'] ?? false);
            $itemObject->setIsDepositable($item['is_depositable'] ?? false);
            $itemObject->setPrice($item['price'] ?? 0);
            $itemObject->setIcon($item['icon']??null);
            self::$arrItems[$id] = $itemObject;
            return $itemObject;
        }
        return null;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'itemId' => $this->itemId,
            'count' => $this->count,
            'cost' => $this->cost,
            'icon' => $this->icon,
            'crystal_type' => $this->crystal_type,
            'itemName' => $this->itemName,
            'addName' => $this->add_name,
            'description' => $this->description,
            'price' => $this->price,
            'isTradable' => $this->is_tradable,
            'isDropable' => $this->is_dropable,
            'type' => $this->type,
            'isSellable' => $this->is_sellable,
            'isDepositable' => $this->is_depositable,
            'isStackable' => $this->is_stackable,
        ];
    }

    public function setEnchant(int $enchant): void
    {
        $this->enchant = $enchant;
    }

    public function getEnchant(): int
    {
        return $this->enchant;
    }

    public function setDate(DateTime|string $date): void
    {
        $this->date = $date;
    }

    public function getDate()
    {
        if($this->date instanceof DateTime) {
            return $this->date->format('Y-m-d H:i:s');
        }
        return $this->date;
    }

}