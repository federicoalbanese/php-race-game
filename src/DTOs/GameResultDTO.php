<?php

namespace Race\DTOs;

readonly class GameResultDTO
{
    /**
     * @param  PlayerResultDTO  $playerOneResultDTO
     * @param  PlayerResultDTO  $playerSecondResultDTO
     * @param  string  $winner
     */
    public function __construct(private PlayerResultDTO $playerOneResultDTO, private PlayerResultDTO $playerSecondResultDTO, private string $winner)
    {
    }

    /**
     * @return PlayerResultDTO
     */
    public function getPlayerOneResultDTO(): PlayerResultDTO
    {
        return $this->playerOneResultDTO;
    }

    /**
     * @return PlayerResultDTO
     */
    public function getPlayerSecondResultDTO(): PlayerResultDTO
    {
        return $this->playerSecondResultDTO;
    }

    /**
     * @return string
     */
    public function getWinner(): string
    {
        return $this->winner;
    }
}