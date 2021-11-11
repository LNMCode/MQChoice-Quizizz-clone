import 'package:equatable/equatable.dart';
import 'package:mobileapplication/models/getroom/room_response.dart';
import 'package:flutter/cupertino.dart';

class GetRoomState extends Equatable {
  const GetRoomState();

  @override
  List<Object> get props => [];
}

class GetRoomStateInitial extends GetRoomState {}

class GetRoomStateLoading extends GetRoomState {}

class GetRoomStateSuccess extends GetRoomState {
  final RoomResponse room_response;
  const GetRoomStateSuccess(this.room_response);
}

class GetRoomStateFail extends GetRoomState {}
