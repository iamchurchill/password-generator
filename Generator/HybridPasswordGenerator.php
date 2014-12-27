<?php

namespace Hackzilla\PasswordGenerator\Generator;

class HybridPasswordGenerator extends ComputerPasswordGenerator
{
    private $_segmentCount = 4;
    private $_segmentLength = 3;
    private $_segmentSeparator = '-';

    /**
     * Generate character list for us in generating passwords
     *
     * @return string Character list
     * @throws \Exception
     */
    public function getCharacterList()
    {
        $characterList = parent::getCharacterList();
        $characterList = \str_replace($this->getSegmentSeparator(), '', $characterList);

        return $characterList;
    }

    /**
     * Generate one password based on options
     *
     * @return string password
     */
    public function generatePassword()
    {
        $characterList = $this->getCharacterList();
        $characters = \strlen($characterList);
        $password = '';

        for ($i = 0; $i < $this->_segmentCount; $i++) {
            if ($password) {
                $password .= $this->getSegmentSeparator();
            }

            for ($j = 0; $j < $this->_segmentLength; $j++) {
                $password .= $characterList[mt_rand(0, $characters - 1)];
            }
        }

        return $password;
    }

    /**
     * Get number of words in desired password
     *
     * @return integer
     */
    public function getLength()
    {
        return $this->getSegmentCount();
    }

    /**
     * Set length of desired password(s)
     *
     * @param integer $characterCount
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setLength($characterCount)
    {
        $this->setSegmentCount($characterCount);

        return $this;
    }

    /**
     * Get number of segments in desired password
     *
     * @return integer
     */
    public function getSegmentCount()
    {
        return $this->_segmentCount;
    }

    /**
     * Set number of segments in desired password(s)
     *
     * @param integer $segmentCount
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setSegmentCount($segmentCount)
    {
        if (!is_int($segmentCount) || $segmentCount < 1) {
            throw new \InvalidArgumentException('Expected positive integer');
        }

        $this->_segmentCount = $segmentCount;

        return $this;
    }

    /**
     * Get number of segments in desired password
     *
     * @return integer
     */
    public function getSegmentLength()
    {
        return $this->_segmentLength;
    }

    /**
     * Set length of segment
     *
     * @param integer $segmentLength
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setSegmentLength($segmentLength)
    {
        if (!is_int($segmentLength) || $segmentLength < 1) {
            throw new \InvalidArgumentException('Expected positive integer');
        }

        $this->_segmentLength = $segmentLength;

        return $this;
    }

    /**
     * Get Segment Separator
     *
     * @return string
     */
    public function getSegmentSeparator()
    {
        return $this->_segmentSeparator;
    }

    /**
     * Set segment separator
     *
     * @param string $segmentSeparator
     *
     * @return \Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator
     * @throws \InvalidArgumentException
     */
    public function setSegmentSeparator($segmentSeparator)
    {
        if (!is_string($segmentSeparator)) {
            throw new \InvalidArgumentException('Expected string');
        }

        $this->_segmentSeparator = $segmentSeparator;

        return $this;
    }
}
